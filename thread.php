<?php if (isset($error_message)) : ?>
  <ul class="errorMessage">
    <?php foreach ($error_message as $error) : ?>
      <li><?php echo $error; ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php foreach ($thread_array as $thread) : ?>
  <div class="threadWrapper">
    <div class="childWrapper">
      <div class="threadTitle">
        <span>【タイトル】</span>
        <h1><?php echo $thread["title"]; ?></h1>
      </div>

      <?php

      // データを入れるための変数
      $comment_array = array();

      // データベースから値を取得する
      $sql = "SELECT * FROM comment";
      $statement = $pdo->prepare($sql);
      $statement->execute();

      $comment_array = $statement;

      ?>

      <section>
        <?php foreach ($comment_array as $comment) : ?>
          <!-- スレッドidとコメントthread_idが一致するとき -->
          <?php if ($thread['id'] == $comment['thread_id']) : ?>
            <article>
              <div class="wrapper">
                <div class="nameArea">
                  <span>名前: </span>
                  <p class="username"><?php echo $comment['username']; ?></p>
                  <time><?php echo $comment['post_date']; ?></time>
                </div>
                <p class="comment"><?php echo $comment['body']; ?></p>
              </div>
            </article>
          <?php endif; ?>
        <?php endforeach; ?>
      </section>

      <?php

      $position = 0;

      if (isset($_POST["submitButton"])) {
        $position = $_POST["position"];
      }

      ?>

      <form class="formWrapper" method="post">
        <div>
          <input type="submit" value="書き込む" name="submitButton">
          <label>名前: </label>
          <input type="text" name="username">
          <input type="hidden" name="threadID" value="<?php echo $thread['id']; ?>">
        </div>
        <div>
          <textarea class="commentTextArea" name="body"></textarea>
        </div>
        <input type="hidden" name="position" value="0">
      </form>
      <!-- jqueryライブラリを読み込む -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
        $(document).ready(() => {
          $("input[type=submit]").click(() => {
            let position = $(window).scrollTop();
            $("input:hidden[name=position]").val(position);
          })
          $(window).scrollTop(<?php echo $position; ?>);
        })
      </script>
    </div>
  </div>
<?php endforeach; ?>