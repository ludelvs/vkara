<?php
/**
 * @package libs.filter
 * @author lude <lude@users.sourceforge.jp>
 */

class RoleAuthenticationFilter extends Mars_Filter
{
  public function doFilter($chain)
  {
    // 認証済みであればアクションを実行
    if ($this->user->isCurrentActionAuthenticated()) {
      
      $chain->filterChain();

    } else {
      $this->messages->addError('ログインを行って下さい。');
      $this->controller->forward('LoginForm');
    }
  }
}
