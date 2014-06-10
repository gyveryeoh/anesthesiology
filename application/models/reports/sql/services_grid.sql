select
    t0.id `service_id`,
    t0.name `service_name`,
    t1.total
from
    anesth_services t0
    left join (
        select
            pf.service `service_id`,
            count(pf.service) `total`
        from
            patient_form `pf`
        {$filters}
        group by
            pf.service
    ) t1
    on t0.id = t1.service_id
    order by t0.name asc