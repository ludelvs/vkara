<?php
/**
 * EventAddConfirm
 * 
 * @author lude <lude@users.sourceforge.jp>
 * @version $Id: EventAddConfirmAction.class.php 86 2011-12-11 00:28:17Z kouda $
 */
class EventAddConfirmAction extends Mars_Action
{
  public function validate()
  {
    // トークンの状態が正常かチェック
    if ($this->user->getTokenState() != Mars_AuthorityUser::TOKEN_VALID) {
      $this->messages->addError('不正な画面遷移です。');

      return FALSE;
    }
    
    $startDate = $this->form->get('start');
    $deadlineDate = $this->form->get('deadline');
    
    $startDateInt = strtotime($startDate['year'] . $startDate['month'] . $startDate['day']);
    $deadlineDateInt = strtotime($deadlineDate['year'] . $deadlineDate['month'] . $deadlineDate['day']);
    
    if ($startDateInt <= $deadlineDateInt) {
      $this->messages->addError('開催日は募集期限日より未来に指定してください。');
      return FALSE;
    }
    
    return TRUE;
  }
  
  public function execute()
  {
    $mixiCommunityList = $this->systemService->getMixiCommunityList();
    
    $this->renderer->setAttribute('mixiCommunityList', $mixiCommunityList);
    
    // アップロードイメージのサンプルを出力
    $tokenId = $this->form->get('tokenId');
    $previewPath = $this->systemService->getIconPreviewPath($tokenId);
    $hasUpload = FALSE;
    
    $uploader = new Mars_ImageUploader('photo1');

    if ($uploader->isUpload()) {
      
      // 実行環境に GD、あるいは Imagick モジュールが組み込まれている場合は、イメージのリサンプリングを行う
      if (Mars_ImageFactory::isEnableImageEngine(Mars_ImageFactory::IMAGE_ENGINE_GD)) {
        $imageEngine = Mars_ImageFactory::IMAGE_ENGINE_GD;
      } else {
        $imageEngine = Mars_ImageFactory::IMAGE_ENGINE_IMAGE_MAGICK;
      }

      if ($imageEngine !== NULL) {
        $uploader->setImageEngine($imageEngine);

        // イメージのリサイズ
        $fillColor = Mars_ImageColor::createFromHTMLColor('#ffffff');

        $image = $uploader->getImage();
        $image->resizeByMaximum(200);

        $image->convertFormat(Mars_Image::IMAGE_TYPE_JPEG);
        $image->save($previewPath);

      } else {
        $uploader->deploy($previewPath);
      }
      
    } else {
      $defaultIconPath = sprintf('%s/webroot/common/images/logo.jpg', APP_ROOT_DIR);
      file_copy($defaultIconPath, $previewPath);
    }

    return Mars_View::SUCCESS;
  }
}
