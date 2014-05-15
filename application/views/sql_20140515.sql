select
    pf.service 'service_id',
    asv.name 'Service',
    count(pf.id) 'Total'
from
    patient_form pf,
    anesth_services asv
where
    pf.service = asv.id
    and pf.type_of_patient = 'C'
    and pf.level_of_involvement = 'P'
group by
    pf.service
order by
    pf.service asc


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

