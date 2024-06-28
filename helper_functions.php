<?php

function str_random($length = 16) {
  return bin2hex(random_bytes($length / 2));
}