<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>


  <section>
    <!-- FORM -->
    <div>
      <form class="" action="<?php echo site_url('app/new_todo'); ?>" method="post">
        <input type="text" name="todo" value="">
        <button type="submit" name="">Save</button>
      </form>
      <?php if(function_exists('validation_errors')) {echo validation_errors();} ?>
    </div>

    <!-- LIST -->
    <div>
      <ul id="todos-container">
      <?php foreach ($todos as $todo) : ?>
        <li class="<?php if($todo->completed) {echo "done";} ?>">
          <!-- CHECK -->
          <div>
            <a href="<?php if($todo->completed) {echo site_url("app/uncheck/$todo->id");} else {echo site_url("app/check/$todo->id");} ?>">
              <?php if($todo->completed) : ?>
                <i class="fa fa-check"></i>
              <?php endif; ?>
            </a>
          </div>
          <!-- TO DO -->
          <div>
            <p><?php echo $todo->text; ?></p>
          </div>

          <!-- BUTTONS -->
          <div>
            <!-- MODIFY -->
            <a href="<?php echo site_url("app/todo/$todo->id"); ?>">
              <i class="fa fa-pencil"></i>
            </a>
            <!-- DELETE -->
            <a href="<?php echo site_url("app/destroy_todo/$todo->id"); ?>" class="delete-todo">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </li>

        <!-- UPLOAD -->
        <li class="attachment-form">
          <div>
            <!--site_url("controller/funzione/...")-->
            <form class="" action="<?php echo site_url("app/new_attachment/$todo->id") ?>" method="post" enctype="multipart/form-data">
              <input type="file" name="file" value="" id="file">
              <button type="submit" name="button">Upload</button>
            </form>
          </div>
        </li>

        <?php if(isset($todo->attachments)) : ?> <!--eseguo l'if se l'attachments esiste e non è vuoto-->
        <ul>
          <?php foreach ($todo->attachments as $attachment) : ?>
          <li>
            <!-- VIEW -->
            <div>
              <a href="<?php echo $this->config->item('resources')['attachments'] ?>
                /<?php echo $attachment->attachment.$attachment->type; ?>">
                  <i class="fa fa-eye"></i>
              </a>
            </div>
            <!-- TO DO -->
            <div>
              <p><?php echo $attachment->attachment.$attachment->type; ?></p> <!--in questo paragrafo si visualizzerà il nome del file caricato e la sua estensione-->
            </div>

            <!-- BUTTONS -->
            <div>
              <!-- DELETE -->
              <a href="<?php echo site_url("app/destroy_attachment/$attachment->idAttachment"); ?>">
                <i class="fa fa-times"></i>
              </a>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

      <?php endforeach; ?>
      </ul>
    </div>
  </section>


  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click','.delete-todo',function(e) {
        e.preventDefault();

        $.ajax({
          'url':$(this).attr('href'),
          'type':'POST',
          'data':{},
          'success':function(data) {
            if(data) {
              $('#todos-container').html(data);
            }
          }
        });
      });
    });
  </script>

