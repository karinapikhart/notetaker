<!DOCTYPE html>
<html>

<head>
  <title>#search</title>
</head>

<body>

  <?php
    // this doesnt seem to work when defined here (globally), outside the functions
    // $script_path = "./hashtag-search.sh"
    
    function getAllHashtags() {
      $script_path = "./hashtag-search.sh";
      exec($script_path, $output, $return_var);
      return $output;
    }
         
    function findHashtagUsage() {
      // The global $_POST variable allows you to access the data sent with the POST method by name
      if (isset($_POST['checkbox'])) {
        $checkedtags = $_POST['checkbox'];
        $script_path = "./hashtag-search.sh";
        foreach( $checkedtags as $tag ):
          $bash_command = $script_path . " " . substr($tag, 1); // remove "#" from beginning of $tag
          echo $tag, '<br/>';
          unset($output);
          exec($bash_command, $output, $return_var);
          foreach( $output as $result ):
            echo $result;
            echo '<br/>';
          endforeach;
          echo '<br/>';
        endforeach;
      }
    }
  ?>

  <h1>Hashtag Search Tool</h1>
  
  <h2>Available hashtags:</h2>
  <p id="hashtagform">
    <form method="post">
      <?php 
        $all_hashtags = getAllHashtags(); 
        foreach( $all_hashtags as $hashtag ): 
      ?>
          <input type="checkbox" id="<?= $hashtag ?>" name="checkbox[]" value="<?= $hashtag ?>" >
          <label for="<?= $hashtag ?>"><?= $hashtag ?></label>
          <br>
      <?php endforeach; ?>
      <input type="submit" value="Submit">
    </form>
  </p>

  <h2>Hashtag Search Results:</h2>
  <p id="hashtagsearchresults">
    <?php findHashtagUsage() ?>
  </p>

</body>
</html>