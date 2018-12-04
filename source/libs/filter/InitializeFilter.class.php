<?php
/**
 * @package libs.filter
 * @author lude <lude@users.sourceforge.jp>
 */

class InitializeFilter extends Mars_Filter
{
  public function doFilter($chain)
  {
    $chain->filterChain();
  }
}
