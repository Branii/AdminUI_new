<?php

#paging       

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



#base

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$allUsers = (new Model)->getAllUsers($page, 8)['data'];
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


UPDATE users
SET username = CONCAT(username, ' test') WHERE uid > 100;