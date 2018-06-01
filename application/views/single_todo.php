<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>


  <section>
    <!-- FORM -->
    <div>
      <form class="" action="<?php echo site_url('app/upd_todo'); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $todo->id; ?>">
        <input type="text" name="todo" value="<?php echo $todo->text; ?>">
        <button type="submit" name="">Update</button>
      </form>
    </div>
  </section>

