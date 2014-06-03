select
    sum(if(upper(pf.critical_events) = 'YES', 1, 0)) `Yes`,
    sum(if(upper(pf.critical_events) = 'NO', 1, 0)) `No`,
    sum(if(upper(pf.critical_events) in ('YES', 'NO'), 1, 0)) `Total`
from
    patient_form `pf`
{$filters}