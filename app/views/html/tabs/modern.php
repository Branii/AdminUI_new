<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<style>
    .pager {
    position: relative; /* Sets positioning context for absolute elements inside */
    padding: 20px;
    height: 80px;
    background-color: #f9f9f9;
}

.top-left-btn {
    position: absolute;
    top: 10px; /* Distance from the top */
    left: 10px; /* Distance from the left */
    padding: 5px 10px;
    /* background-color: #007bff; */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.top-right-btn {
    position: absolute;
    top: 10px; /* Distance from the top */
    right: 10px; /* Distance from the right */
    padding: 5px 10px;
    /* background-color: #28a745; */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.top-left-btn:hover {
    /* background-color: #0056b3; */
}

.top-right-btn:hover {
    /* background-color: #218838; */
}
</style>
<div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
              <h4 class="card-title mb-0">Basic Table</h4>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">User</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Project Name</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Team</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                      </th>
                      <th>
                        <h6 class="fs-4 fw-semibold mb-0">Budget</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="dataContainer">

                  <?php
                   $page = isset($_GET['page']) ? $_GET['page'] : 1;
                   $allUsers = (new Model)->getAllUsers($page, 8);
                   foreach ($allUsers as $user) {
                    ?>
                   
                   <tr>
                        <td><?=$user['uid']?></td>
                        <td><?=$user['username']?></td>
                        <td><?=$user['nickname']?></td>
                        <td><?=$user['user_email']?></td>
                        <td><?=$user['user_dob']?></td>
                        <td>
                            <button class="btn btn-primary" onclick="viewDetails(<?=$user['uid']?>)">View</button>
                            <button class="btn btn-danger" onclick="deleteRecord(<?=$user['uid']?>)">Delete</button>
                        </td>
                   </tr>

                    <?php
                   }


                    ?>
                                    

                  </tbody>
                </table>
              </div>
            </div>
            <div class="px-4 py-3 border-top pager">
            <span class="top-left-btn">
            <div class="btn-group mb-2" role="group" aria-label="Basic example" style="border:solid 1px #eee;color:#bbb">
                    <button type="button" class="btn bg-white-subtle " >
                    <i class='bx bx-chevron-left' style="font-size:20px"></i>
                    </button>
                    <button type="button" class="btn bg-white-subtle ">
                    <i class='bx bx-minus' style="font-size:20px"></i>
                    </button>
                    <button type="button" class="btn bg-white-subtle ">
                    <i class='bx bx-chevron-right' style="font-size:20px"></i>
                    </button>
                  </div>
            </span>
            <span class="top-right" aria-label="Page navigation example">
            <?php
            
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $pages = (new Model)->paginateAllUsers($page, 5);
            $totalPages = count($pages['pages']);

            $pagLink = "<ul class='pagination justify-content-end'>";

            // Previous button
            $prevPage = max(1, $page - 1);
            $pagLink .= "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'><a class='page-link' href='index.php?page=$prevPage'><i class='bx bx-chevron-left'></i></a></li>";

            // Page numbers with ellipsis
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    $pagLink .= "<li class='page-item active'><a class='page-link'>$i</a></li>";
                } elseif ($i <= 1 || $i >= $totalPages || abs($i - $page) <= 2) {
                    $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
                } elseif ($i == $page - 3 || $i == $page + 3) {
                    $pagLink .= "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                }
            }

            // Next button
            $nextPage = min($totalPages, $page + 1);
            $pagLink .= "<li class='page-item " . ($page == $totalPages ? 'disabled' : '') . "'><a class='page-link' href='./home/$nextPage'><i class='bx bx-chevron-right'></i></a></li>";

            $pagLink .= "</ul>";

            echo $pagLink;
           
            ?>


            
            </span>
    
            </div>
          </div>
        </div>
      </div>