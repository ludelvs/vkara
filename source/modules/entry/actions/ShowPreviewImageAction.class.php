<?php
/**
 * @package modules.entry.actions
 * @author lude <lude@users.sourceforge.jp>
 */

class ShowPreviewImageAction extends Mars_Action
{
  public function validate()
  {
    if ($this->user->getTokenState() == Mars_AuthorityUser::TOKEN_VALID) {
      return TRUE;
    }

    return FALSE;
  }

  public function validateErrorHandler()
  {
    return Mars_View::NONE;
  }

  public function execute()
  {
    $tokenId = $this->request->getPathInfo('tokenId');
    $previewPath = $this->systemService->getIconPreviewPath($tokenId);

    if (is_file($previewPath)) {
      $data = read_file($previewPath);
      $this->response->writeBinary($data, 'image/jpeg');
    }

    return Mars_View::NONE;
  }
}
