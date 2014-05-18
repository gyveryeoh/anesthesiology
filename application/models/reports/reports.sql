-- patient_type_matrix
select
    *,
    (`total_elective` + `total_emergency`) `total_overall`
from (
    select
        *,
        (`charity_primary_elective` + `charity_assist_elective` + `pay_primary_elective` + `pay_assist_elective`) `total_elective`,
        (`charity_emergency` + `pay_emergency`) `total_emergency`,
        (`charity_primary_elective` + `charity_assist_elective` + `charity_emergency`) `total_charity`,
        (`pay_primary_elective` + `pay_assist_elective` + `pay_emergency`) `total_pay`
    from (
        select
            (
                -- charity: primary elective
                select
                    count(pf.id)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'C'
                    and pf.level_of_involvement = 'P'
            ) `charity_primary_elective`,
            (
                -- charity: assist elective
                select
                    count(pf.id)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'C'
                    and pf.level_of_involvement = 'A'
            ) `charity_assist_elective`,
            (
                -- pay: primary elective
                select
                    count(pf.id)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'P'
                    and pf.level_of_involvement = 'P'
            ) `pay_primary_elective`,
            (
                -- pay: assist elective
                select
                    count(pf.id)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'P'
                    and pf.level_of_involvement = 'A'
            ) `pay_assist_elective`,
            (
                -- charity: primary emergency
                select
                    count(pf.id)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'C'
                    and pf.level_of_involvement = 'Y'
            ) `charity_emergency`,
            (
                -- pay: primary emergency
                select
                    count(pf.id)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'P'
                    and pf.level_of_involvement = 'Y'
            ) `pay_emergency`
    ) `pf1`
) `pf2`

-- services_grid
select
    pf.service `service_id`,
    asv.name `service_name`,
    count(pf.service) `total`
from
    patient_form `pf`,
    anesth_services `asv`
where
    pf.service = asv.id
group by
    pf.service
order by
    pf.service asc
;

-- services_techniques_grid
select
    pf.service `service_id`,
    asv.name `service_name`,
    pf.anesthetic_technique `technique_id`,
    at.name `technique_name`,
    count(pf.anesthetic_technique) `technique_total`
from
    patient_form `pf`,
    anesth_services `asv`,
    anesth_technique `at`
where
    pf.service = asv.id
    and pf.anesthetic_technique = at.id
group by
    pf.anesthetic_technique
order by
    pf.service asc,
    at.id asc
;

select
    pf.service `service_id`,
    asv.name `service_name`,
    pf.anesthetic_technique `technique_id`,
    at.name `technique_name`,
    count(pf.anesthetic_technique) `technique_total`
from
    patient_form `pf`,
    anesth_services `asv`,
    anesth_technique `at`
where
    pf.service = asv.id
    and pf.anesthetic_technique = at.id
group by
    pf.service,
    pf.anesthetic_technique
order by
    pf.service asc,
    pf.anesthetic_technique asc
;


select
    *
from 
anesth_services t0
left join (
    select
        pf.service `id`,
        count(pf.anesthetic_technique) `total`
    from
        patient_form `pf`
    where
        pf.anesthetic_technique = 1
    group by
        pf.service,
        pf.anesthetic_technique
) t1
    on t0.id = t1.service_id
left join (
    select
        pf.service `id`,
        count(pf.anesthetic_technique) `total`
    from
        patient_form `pf`
    where
        pf.anesthetic_technique = 2
    group by
        pf.service,
        pf.anesthetic_technique
) t2
    on t1.service_id = t2.service_id
;
