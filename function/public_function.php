<?php
  // htmlspecialcharsの実行関数
  function hsc($str) {
    return htmlspecialchars($str, ENT_QUOTES, "utf-8");
  }
