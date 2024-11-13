$(function () {

    const template = (data) => {
  
      let html = "";
      data.forEach((item) => {
        html += `
                  <tr>
                      <td>${item.uid}</td>
                      <td>${item.username}</td>
                      <td>${item.nickname}</td>
                      <td>${item.user_email}</td>
                      <td>${item.user_dob}</td>
                      <td>${item.user_contact}</td>
                      <td>${item.company}</td>
                      <td>${item.agent}</td>
                      <td>${item.balance}</td>
                      <td>${item.rebate}</td>
                      <td>
                          
                           <div class="dropdown">
                                  <a class="dropdown-toggles" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                   <i class='bx bx-dots-vertical-rounded'></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1"  style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                    <a class="dropdown-item kanban-item-edit cursor-pointer d-flex align-items-center gap-1" href="javascript:void(0);">
                                      <i class='bx bx-user-check' ></i>View
                                    </a>
                                    <a class="dropdown-item kanban-item-edit cursor-pointer d-flex align-items-center gap-1" href="javascript:void(0);">
                                      <i class='bx bx-pencil' ></i>Edit
                                    </a>
                                    <a class="dropdown-item kanban-item-delete cursor-pointer d-flex align-items-center gap-1" href="javascript:void(0);">
                                      <i class="bx bx-trash fs-5"></i>Delete
                                    </a>
                                  </div>
                                </div>
                      </td>
                  </tr>
              `;
      });
      return html;
    };
  
    const render = (data) => {
      var html = template(data);
      $("#dataContainer").html(html);
    };
  
    let currentPage = 1;
    let pageLimit = 9;
  
    async function fetchUsers(page) {
      try {
        const response = await fetch(`../admin/homedata/${page}/${pageLimit}`);
        const data = await response.json();
  
        // Render table data
        render(data.users);
  
        // Render pagination
        renderPagination(data.totalPages, page);
                document.getElementById("paging_info").innerHTML = 'Page ' + page + ' of ' + data.totalPages + ' pages'
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    }
  
    function renderPagination(totalPages, currentPage) {
      let pagLink = `<ul class='pagination justify-content-end'>`;
  
      // Previous Button
      pagLink += `
              <li class='page-item ${currentPage === 1 ? "disabled" : ""}'>
                  <a class='page-link' href='#' data-page='${
                    currentPage - 1
                  }'><i class='bx bx-chevron-left'></i></a>
              </li>
          `;
  
      // Page numbers with ellipsis
      for (let i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
          pagLink += `<li class='page-item active'><a class='page-link' href='#'>${i}</a></li>`;
        } else if (
          i === 1 ||
          i === totalPages ||
          Math.abs(i - currentPage) <= 2
        ) {
          pagLink += `<li class='page-item'><a class='page-link' href='#' data-page='${i}'>${i}</a></li>`;
        } else if (i === currentPage - 3 || i === currentPage + 3) {
          pagLink += `<li class='page-item disabled'><a class='page-link'>...</a></li>`;
        }
      }
  
      // Next Button
      pagLink += `
              <li class='page-item ${
                currentPage === totalPages ? "disabled" : ""
              }'>
                  <a class='page-link' href='#' data-page='${
                    currentPage + 1
                  }'><i class='bx bx-chevron-right'></i></a>
              </li>
          `;
  
      pagLink += "</ul>";
      document.getElementById("pagination").innerHTML = pagLink;

  
      // Add click event listeners to pagination links
      document.querySelectorAll("#pagination .page-link").forEach((link) => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          const newPage = parseInt(this.getAttribute("data-page"));
          if (newPage > 0 && newPage <= totalPages) {
            currentPage = newPage;
            document.getElementById("paging_info").innerHTML = 'Page ' + currentPage + ' of ' + totalPages + ' pages'
            fetchUsers(currentPage);
            
          }
        });
      });
    }
  
    fetchUsers(currentPage);
  
  
  $(".player").click(function(){
  
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
  
  
  });