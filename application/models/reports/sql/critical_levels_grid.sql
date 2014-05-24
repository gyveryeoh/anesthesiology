select
    t0.id,
    t0.code,
    t0.name,
    t1.*
from
    critical_level_{$level} t0
    left join (
        select
            t1.critical_level_{$key}_id `id`,
            count(t1.id) `total`
        from
            patient_form_critical_level_{$key}_details t1
            left join patient_form t2
                on t1.patient_form_id = t2.id
        {$filters}
        group by
            t1.critical_level_{$key}_id
    ) t1
        on t0.id = t1.id