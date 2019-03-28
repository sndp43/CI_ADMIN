   <?php if(!null == $this->session->flashdata("flash_messege")) { ?>
                <div class="<?= $this->session->flashdata("flash_error_class") ?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?= $this->session->flashdata("flash_messege") ?>
                </div>

   <?php } ?>