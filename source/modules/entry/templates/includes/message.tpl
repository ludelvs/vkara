        <?php if ($html->hasMessage()) : ?>        
          <div data-alert="alert" class="alert-message success fade in">
            <a class="close" href="#">×</a>
            <?php echo $html->messages(); ?>
          </div>      
        <?php endif; ?>
        <?php if ($html->errors(TRUE)) : ?>        
          <div data-alert="alert" class="alert-message error fade in">
            <a class="close" href="#">×</a>
            <?php if ($form->containFieldErrors()): ?>
              <?php echo $form->containFieldErrors() ?>
            <?php else: ?>
              <?php echo $html->errors(FALSE) ?>
            <?php endif; ?>
          </div>      
        <?php endif; ?>