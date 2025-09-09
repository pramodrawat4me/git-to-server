<?php
// Remote PDF file (S3 link)
$fileUrl = "https://s3.us-east-1.amazonaws.com/business.unboundxinc.com/unbound-x-Investor-deck.pdf";

// Force browser to download
$filename = "unbound-x-Investor-deck.pdf";

header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

readfile($fileUrl);
exit;
?>
