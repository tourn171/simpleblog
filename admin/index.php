<?php include 'menu.php'?>

<table>
    <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php 
    try
    {
        $stmt = $db->query('SELECT postID,postTitle,postDate FROM blog_posts ORDER BY postID DESC');
        while($row = $stmt->fetch())
        {
            echo '<tr>';
            echo '<td>'.$row['postTitle'].'</td>';
            echo '<td>'.$row['postDate'].'</td>';
            ?>
            <td>
            <a href = "edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> |
            <a href = "javascript:delpost('<?php echo $row['postID'];?>">Delete</a>
            </td>
            <?php
            echo '</tr>';
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    ?>
</table>

<script type="text/javascript" language="JavaScript">
function delpost(id,title){
    if(confirm("Are you sure you want to delet'"+title+"'"))
    {
        window.location.href = 'index.php?delpost='+id;
    }
}
</script>

<?php
if(isset($_GET['delpost'])){
    $stmt = $db-prepare('Delete FROM blog_post WHERE postID = :postID');
    $stmt->execute(array(':postID'=>$_GET['delpost']));
    
    header('Location: index.php?action=deleted');
    exit();
}
if(isset($_GET['action']))
{
    echo "<h3>Post".$_GET['action']."</h3>";
}
?>
