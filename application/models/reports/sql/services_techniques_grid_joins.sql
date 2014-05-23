
left join (
    select
        pf.service `id`,
        count(pf.anesthetic_technique) `total`
    from
        patient_form `pf`,
        anesth_technique `atq`
    where
        pf.anesthetic_technique = {$id}
        and pf.anesthetic_technique = atq.id
        {$filters}
    group by
        pf.service,
        pf.anesthetic_technique
    union (
        select
            -111 `id`,
            count(pf.anesthetic_technique) `total`
        from
            patient_form `pf`,
            anesth_technique `atq`
        where
            pf.anesthetic_technique = {$id}
            and pf.anesthetic_technique = atq.id
            {$filters}
    )
) t{$next}
    on t0.id = t{$next}.id
