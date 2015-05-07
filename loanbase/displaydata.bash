#!/bin/bash
mysql --local-infile --user=root --password=rootpass  <<STOP
use borrowbase;

select  borrowers.borrower_name,items.item_name
from
	transactions join items join borrowers
where
	transactions.item_id = items.item_id
	and
	borrowers.borower_id = transactions.borrower_id
;
STOP
