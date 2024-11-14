<style>
  .pager {
    position: relative;
    /* Sets positioning context for absolute elements inside */
    padding: 20px;
    height: 80px;
    background-color: #f9f9f9;
  }

  .pager1 {
    position: relative;
    /* Sets positioning context for absolute elements inside */
    padding: 20px;
    height: 80px;
    background-color: #f9f9f9;
  }

  .top-left-btn {
    position: absolute;
    top: 10px;
    /* Distance from the top */
    left: 10px;
    /* Distance from the left */
    padding: 5px 10px;
    /* background-color: #007bff; */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .top-center {
    position: absolute;
    top: 50%;
    /* Vertically centers the button */
    left: 50%;
    /* Horizontally centers the button */
    transform: translate(-50%, -50%);
    /* Adjusts for button size */
    padding: 5px 15px;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .top-right-btn {
    position: absolute;
    top: 10px;
    /* Distance from the top */
    right: 10px;
    /* Distance from the right */
    padding: 5px 10px;
    /* background-color: #28a745; */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .topp-right {
    position: absolute;
    top: 10px;
    /* Distance from the top */
    right: 10px;
    /* Distance from the right */
    padding: 5px 10px;
    /* background-color: #28a745; */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .table-wrapper {
    overflow: hidden;
    /* Hide the default scrollbar */
    white-space: nowrap;
    max-width: 100%;
    /* Adjust based on your needs */
    margin-bottom: 10px;
    top: 0;
    left: 0;
    right: 0;
    height: 10px;
    background: rgb(38, 57, 77) 0px 20px 30px -10px;
    /* Ensure it doesn't interfere with content */
    z-index: 10;
  }

  .queryholder {
    width: 19%;
    margin-right: 5px;
    background-color: #FFF;
  }

  .user-option {
    width: 100%;
    /* Makes each option fill the select width */
    white-space: nowrap;
    /* Prevents text from wrapping */
    text-align: left;
    /* Adds some spacing inside the option */
    border-bottom: solid 1px #ccc;
  }

  .user-option:hover {
    background-color: #eee;
  }

  #userDropdown {
    max-height: 300px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
</style>
<div class="card w-100 position-relative overflow-hidden">
  <div class="px-4 py-3 border-bottom">
    <h4 class="card-title mb-0">Account Transactions</h4>
  </div>

  <div class="px-4 py-3 border-bottom pager1">
    <span class="top-left-btn">
      <div class="btn-group mb-2" role="group" aria-label="Basic example" style="padding:5px;width:auto">



        <input type="text" class="form-control queryholder username" id="nametext" aria-describedby="name"
          placeholder="Name" />
        <div id="userDropdown" class=" form-control " size="5"
          style="background-color:#fff;position: absolute; top: 90%; width: 19%; display: none; z-index: 1000;">

        </div>


        <input type="text" class="form-control queryholder orderid" id="nametext" aria-describedby="name"placeholder ="enter oderid">


        <select name="order_type" class="form-control form-select queryholder ordertype" data-bs-placeholder="Select Type">
          <option value="all">all</option>
          <option value="1">Deposit</option>
          <option value="2">Win Bonus</option>
          <option value="3">Bet Awarded</option>
          <option value="4">Withdrawal</option>
          <option value="6">Bet Cancelled</option>
        </select>



        <input type="date" class="form-control queryholder startdate" id="nametext" aria-describedby="name" placeholder="Name" />



        <input type="date" class="form-control queryholder enddate" id="nametext" aria-describedby="name" placeholder="Name" />



      </div>
    </span>
    <span class="top-center" aria-label=" navigation example">
      <!--enter is free-->
    </span>
    <span class="topp-right" id="paginations" aria-label="Page navigation example">

      <div class="btn-group mb-2" role="group" aria-label="Basic example"
        style="border:solid 1px #eee;color:#bbb;background-color:#fff">
        <button type="button" class="btn bg-white-subtle player refresh" value="right" aria-label="Refresh"
          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Refresh">
          <i class='bx bx-refresh' style="font-size:20px"></i>
        </button>
        <button type="button" class="btn bg-white-subtle executetrans" value="end" aria-label="Execute"
          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Execute">
          <i class='bx bx-check-double loader' style="font-size:20px"></i>
        </button>
      </div>

    </span>

  </div>

  <div class="card-body p-4">
    <div class="table-responsive mb-4 border rounded-1 table-wrapper" id="mask" style="height:530px;overflow-y:scroll;">
      <table class="table text-nowrap mb-0 align-middle table-bordered">
        <thead class="text-dark fs-4">
          <tr>
            <th>
              <h6 class="fs-4 fw-semibold mb-0">ID Number</h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0">User Name</h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0">Transaction Type</h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0"> Amount </h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0">Balance</h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0">Date/Time</h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0">Transaction ID</h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0">Status</h6>
            </th>
            <th>
              <h6 class="fs-4 fw-semibold mb-0"><i class='bx bx-dots-vertical-rounded'></i></h6>
            </th>
          </tr>
        </thead>
        <tbody id="dataContainer">

          <!--Dynamic content here-->

        </tbody>
      </table>
    </div>
  </div>
  <div class="px-4 py-3 border-top pager">
    <span class="top-left-btn">
      <div class="btn-group mb-2" role="group" aria-label="Basic example"
        style="border:solid 1px #eee;color:#bbb;background-color:#fff">
        <button type="button" class="btn bg-white-subtle player" value="start">
          <i class='bx bx-chevrons-left' style="font-size:20px"></i>
        </button>
        <button type="button" class="btn bg-white-subtle player" value="left">
          <i class='bx bx-chevron-left' style="font-size:20px"></i>
        </button>
        <button type="button" class="btn bg-white-subtle player" value="right">
          <i class='bx bx-chevron-right' style="font-size:20px"></i>
        </button>
        <button type="button" class="btn bg-white-subtle player" value="end">
          <i class='bx bx-chevrons-right' style="font-size:20px"></i>
        </button>
      </div>
    </span>
    <span class="top-center" aria-label=" navigation example">

      <span id="paging_info" style="color:#aaa">---</span>

    </span>
    <span class="top-right" id="pagination" aria-label="Page navigation example">

      <!--Dynamic pagination-->

    </span>

  </div>
</div>
</div>
</div>