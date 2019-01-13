<!DOCTYPE html>
<html>

<head>
  <title>#search</title>
</head>

<body>

  <script language="JavaScript">
    function toggle_all_boxes(source) {
      checkboxes = document.getElementsByName('checkbox[]');
      for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = source.checked;
      }

      // this wasnt working... don't know why. so used the for loop strategy above
      // for(var checkbox in checkboxes) { 
      //  checkbox.checked = source.checked;
      // }
    }
  </script>

  <?php
    // this doesnt seem to work when defined here (globally), outside the functions
    $script_path = "./hashtag-search.sh";
    
    function getAllHashtags() {
      global $script_path;
      exec($script_path, $output, $return_var);
      return $output;
    }
    
    function getCheckedBoxes() {
      $checked_boxes = []; 
      // The global $_POST variable allows you to access the data sent with the POST method by name
      if (isset($_POST['checkbox'])) {
        $checked_boxes = $_POST['checkbox'];
      }
      return $checked_boxes;
    }
    
    function buildHashtagForm() {
      $all_hashtags = getAllHashtags();
      $checked_hashtags = getCheckedBoxes();
      foreach($all_hashtags as $hashtag): 
        if (in_array($hashtag, $checked_hashtags)) {
          $do_check = 'checked';
        } else {
          $do_check = '';
        }
        echo '<input type="checkbox" id="' . $hashtag . '" name="checkbox[]" value="' . $hashtag . '" ' . $do_check . '>';
        echo '<label for="' . $hashtag . '">' . $hashtag .'</label>';
        echo '<br>';
      endforeach;
    }
         
    function getHashtagUsage() {
      global $script_path;
      $checked_boxes = getCheckedBoxes();
      if (sizeof($checked_boxes) > 0) {
        echo '<h2>Hashtag Search Results:</h2>';
        echo '<p id="hashtagsearchresults">';
        foreach( $checked_boxes as $tag ):
          $bash_command = $script_path . " " . substr($tag, 1); // remove "#" from beginning of $tag
          echo '<h3>', $tag, '</h3>';
          unset($output);
          exec($bash_command, $output, $return_var);
          foreach( $output as $result ):
            echo $result, '<br><br>';
          endforeach;
        endforeach;
        echo '</p>';
      }
    }
  ?>

  <h1>Hashtag Search Tool</h1>
  
  <h2>Available Hashtags:</h2>
  <p id="hashtagform">
    <form method="post">
      <input type="checkbox" onClick="toggle_all_boxes(this)" />(all)<br/>
      <?php buildHashtagForm() ?>
      <input type="submit" value="Submit">
    </form>
  </p>

  <?php getHashtagUsage() ?>

</body>
</html>