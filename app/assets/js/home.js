$(function () {

  const AccountTransactions = (data) => {

    let html = "";
    const status = {
      1: "Deposit",
      2: "Win Bonus",
      3: "Bet Awarded",
      4: "Withdrawal",
      5: "Bet Cancelled",
      6: "Bet Deduct",
      7: "Rebates",
      8: "Self Rebate",
      9: "Send Red Envelope",
      10: "Receive Red Envelope",
      11: "Bet Refund"
    }

    data.forEach((item) => {
      html += `
                  <tr>
                      <td>${item.order_id.substring(0, 7)}</td>
                      <td>${item.username}</td>
                      <td>${status[item.order_type]}</td>
                      <td>${item.account_change}</td>
                      <td>${item.balance}</td>
                      <td>${item.dateTime}</td>
                      <td>${item.order_id}</td>
                      <td><i class='bx bxs-circle' style='color:#1dd846;font-size:8px'></i> Complete</td>
                      <td><i class='bx bx-info-circle' style='color:#868c87;font-size:18px;cursor:pointer;' ></i></td>
                  </tr>
              `;
    });
    return html;
  };

  const render = (data) => {
    var html = AccountTransactions(data);
    $("#dataContainer").html(html);
  };

  let currentPage = 1;
  let pageLimit = 50;

  async function fetchTrasaction(page) {
    try {
      const response = await fetch(`../admin/transactiondata/${page}/${pageLimit}`);
      const data = await response.json();

      $("#mask").LoadingOverlay("hide")
      render(data.users);

      // Render pagination
      renderPagination(data.totalPages, page, 'normal');
      document.getElementById("paging_info").innerHTML = 'Page ' + page + ' of ' + data.totalPages + ' pages'
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  }

  async function filterTrasaction(page,username,orderid,ordertype,startdate,enddate) {
    try {
      const response = await fetch(`../admin/filtertransactions/${username}/${orderid}/${ordertype}/${startdate}/${enddate}/${page}/${pageLimit}`);
      const data = await response.json();

      $(".loader").removeClass('bx bx-loader bx-spin').addClass('bx bx-check-double');
      if(data.transactions.length < 1){
        let html = `
            <tr class="no-results" >
            <td colspan="9">
                 <img src="http://localhost/admin/app/assets/images/not_found1.jpg" width="150px" height="150px" />
            </td>
         </tr>`
         $("#dataContainer").html(html);
        return 
      }
      render(data.transactions);

      // Render pagination
      renderPagination(data.totalPages, page, 'search',username,orderid,ordertype,startdate,enddate);
      document.getElementById("paging_info").innerHTML = 'Page ' + page + ' of ' + data.totalPages + ' pages'
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  }


  function renderPagination(totalPages, currentPage, pagingType = '',username='',orderid='',ordertype='',startdate='',enddate='') {
    const createPageLink = (i, label = i, disabled = false, active = false) => 
      `<li class='page-item ${disabled ? "disabled" : ""} ${active ? "active" : ""}'>
        <a class='page-link' href='#' data-page='${i}'>${label}</a>
      </li>`;
    let pagLink = `<ul class='pagination justify-content-end'>`;
  
    // Previous Button
    pagLink += createPageLink(currentPage - 1, `<i class='bx bx-chevron-left'></i>`, currentPage === 1);
  
    // Page numbers with ellipsis
    for (let i = 1; i <= totalPages; i++) {
      if (i === 1 || i === totalPages || Math.abs(i - currentPage) <= 2) {
        pagLink += createPageLink(i, i, false, i === currentPage);
      } else if (i === currentPage - 3 || i === currentPage + 3) {
        pagLink += createPageLink(i, "...", true);
      }
    }
  
    // Next Button
    pagLink += createPageLink(currentPage + 1, `<i class='bx bx-chevron-right'></i>`, currentPage === totalPages);
    pagLink += "</ul>";
  
    document.getElementById("pagination").innerHTML = pagLink;
  
    // Add click event listeners
    document.querySelectorAll("#pagination .page-link").forEach(link => {
      link.addEventListener("click", function (e) {
        e.preventDefault();
        const newPage = +this.getAttribute("data-page");
        if (newPage > 0 && newPage <= totalPages) {
          pagingType === 'search' ? filterTrasaction(newPage,username,orderid,ordertype,startdate,enddate) : fetchTrasaction(newPage);
        }
      });
    });
  }
  

  fetchTrasaction(currentPage);


  $(".player").click(function () {

    let direction = $(this).val();
    const tableWrapper = $(".table-wrapper");
    const tableWrappers = document.querySelector(".table-wrapper");
    const scrollAmount = 1000; // Adjust as needed
    const scrollOptions = {
      behavior: 'smooth',
    };
    if (tableWrapper.length) {

      switch (direction) {
        case 'left':
          tableWrappers.scrollBy({ left: -scrollAmount, ...scrollOptions });
          break;
        case 'right':
          tableWrappers.scrollBy({ left: scrollAmount, ...scrollOptions });
          break;
        case 'start':
          // Scroll to the absolute start (leftmost position)
          tableWrapper.animate({ scrollLeft: 0 }, 'slow');
          break;
        case 'end':
          const maxScrollLeft = tableWrapper[0].scrollWidth - tableWrapper[0].clientWidth;
          tableWrapper.animate({ scrollLeft: maxScrollLeft }, 'slow');
          break;
        default:
          break;
      }


    }
  })

  $(".refresh").click(function () {
    $("#mask").LoadingOverlay("show", {
      background: "rgb(90,106,133,0.1)",
      size: 3
    });
    fetchTrasaction(currentPage);
  })

  let timeout;
  let userId;
  function performSearch() {
    const query = $('.username').val();
    $.post(`../admin/filterusername/${query}`, function (response) {

      if (typeof response === 'string') {
        $("#userDropdown").hide();
      } else if (typeof response === 'object') {
        let html = ''
        response.sort();
        response.forEach((user) => {
          html += `<div value="${user.uid}" class="option">${user.username}</div>`;
        });
        $("#userDropdown").html(html).show()
      }
    })
  }

  $(document).on("input", '.username', function () {
    clearTimeout(timeout);
    timeout = setTimeout(performSearch, 300);
  })

  $(document).on('click', '.option', function () {
    $(".username").val($(this).text())
    userId = $(this).attr('value')
    $(".userId").val(userId)
    console.log(userId)
    $("#userDropdown").hide()
  })

  $(document).on('click', '.executetrans', function () {
    const username = $(".userId").val()
    const orderid = $(".orderid").val()
    const ordertype = $(".ordertype").val()
    const startdate = $(".startdate").val()
    const enddate = $(".enddate").val()
    //console.log(username);
    $(".loader").removeClass('bx-check-double').addClass('bx-loader bx-spin');
    setTimeout(() => {
      filterTrasaction(currentPage,username,orderid,ordertype,startdate,enddate);
    }, 200);
  })

  // $(document).on('click', function (event) {
  //   if (!$(event.target).closest('.username, #userDropdown').length) {
  //     $("#userDropdown").hide(); // Hide dropdown if click is outside input and dropdown
  //   }
  // });

});