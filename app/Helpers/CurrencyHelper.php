<?php

function currency($value)
{
    return number_format($value) . '<abbr class="currency-symbol" title="quid">&#587;</abbr>';
}
