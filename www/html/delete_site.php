
<?php foreach ($data as $data): ?>
          
          <h2>Would you like to delete
            <?php echo $data['title'] ?>?
          </h2>
          <button onclick="window.location.href ='admin.php'">NO TAKE ME BACK</button>
          <h3>To delete please type in the site name as seen above.</h3>
          <h3>Your answer is case sensitive.</h3>
          <form action='admin.php' method='post'>
            <input type='hidden' name='update' value='delete_stop'>
            <input type='hidden' name='site_id' value='<?php echo $data['id'] ?>'>
            <input type='text' name='name'>
            <input type='submit' value='DELETE'>
          </form>
<?php endforeach; ?>
    