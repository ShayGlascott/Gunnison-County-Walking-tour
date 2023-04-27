<?php foreach ($data as $site): ?>
          <h1>Edit site information for
            <?php echo $site['title']; ?>
          </h1>
          <table>
            <tr>
              <td>
                <form action='editor.php' method="POST" enctype="multipart/form-data">

                  <div class="image-preview">
                    <label for="1file">First Image:</label>
                    <input type="file" name="1file" value="pictures/<?php echo $site['img1_fname'] ?>" accept="image/*"
                      onchange="previewImage(event, '1file')"><br>
                    <img id="preview_1file" class="preview_img" src="pictures/<?php echo $site['img1_fname'] ?>" /><br>
                  </div>
              </td>
              <td>
                <div class="image-preview">
                  <label for="2file">Second Image:</label>
                  <input type="file" name="2file" value="pictures/<?php echo $site['img2_fname'] ?>" accept="image/*"
                    onchange="previewImage(event, '2file')"><br>
                  <img id="preview_2file" class="preview_img" src="pictures/<?php echo $site['img2_fname'] ?>" /><br>
                </div>
              </td>
            </tr>
            <tr>
              <script>
                function previewImage(event, inputId) {
                  var reader = new FileReader();
                  reader.onload = function () {
                    var outputId = "preview_" + inputId;
                    var output = document.getElementById(outputId);
                    output.src = reader.result;
                  }
                  reader.readAsDataURL(event.target.files[0]);
                }
              </script>
              <td colspan="2">
                <!--form to upload/update files -->
                <input type='hidden' name='site_id' value="<?php echo $site_id; ?>">
                <input type="hidden" name="function" value="edit_site_page">
                <input type="submit" name="submit" value="Add Images">
                </form>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <button onclick="window.location.href ='editText1.php?id=<?php echo $site_id; ?>'">Edit Introduction
                  Text</button>
                <button onclick="window.location.href ='editText2.php?id=<?php echo $site_id; ?>'">Edit Read More
                  Text</button>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <!--form to post updated to the admin page -->
                <form action="admin.php" method="POST" enctype="multipart/form-data">
                  <input type='hidden' name='update' value='site'>
                  <input type='hidden' name='update_site_id' value='<?php echo $site_id; ?>'>

                  <label for="title">Title:</label>
                  <input type="text" name="title" value="<?php echo $site['title']; ?>" required><br>

                  <label for="img1_alt">First Image alt Text:</label>
                  <input id='textboxid' type="text" name="img1_alt" value="<?php echo $site['img1_altText']; ?>" required><br>
                  <label for="img1_cap">First Image Caption:</label>
                  <input id='textboxid' type="text" name="img1_cap" value="<?php echo $site['img1_caption']; ?>" required><br>

                  <label for="img2_alt">Second Image alt Text:</label>
                  <input id='textboxid' type="text" name="img2_alt" value="<?php echo $site['img2_altText']; ?>" required><br>
                  <label for="img2_cap">Second Image Caption:</label>
                  <input id='textboxid' type="text" name="img2_cap" value="<?php echo $site['img2_caption']; ?>" required><br>

                  <input type="submit" name="submit" value="UPDATE">
                </form>
              </td>
            </tr>

          </table>
        <?php endforeach; ?>