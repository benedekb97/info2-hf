<?php

namespace Auto;

unset($_SESSION['user_id']);

header("Location: ".Router::getLink('index'));