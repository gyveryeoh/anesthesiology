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
                    count(pf.level_of_involvement)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'C'
                    and pf.level_of_involvement = 'P'
                    {$filters}
            ) `charity_primary_elective`,
            (
                -- charity: assist elective
                select
                    count(pf.level_of_involvement)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'C'
                    and pf.level_of_involvement = 'A'
                    {$filters}
            ) `charity_assist_elective`,
            (
                -- pay: primary elective
                select
                    count(pf.level_of_involvement)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'P'
                    and pf.level_of_involvement = 'P'
                    {$filters}
            ) `pay_primary_elective`,
            (
                -- pay: assist elective
                select
                    count(pf.level_of_involvement)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'P'
                    and pf.level_of_involvement = 'A'
                    {$filters}
            ) `pay_assist_elective`,
            (
                -- charity: emergency
                select
                    count(pf.for_emergency)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'C'
                    and pf.for_emergency = 'Y'
                    {$filters}
            ) `charity_emergency`,
            (
                -- pay: emergency
                select
                    count(pf.for_emergency)
                from
                    patient_form pf
                where
                    pf.type_of_patient = 'P'
                    and pf.for_emergency = 'Y'
                    {$filters}
            ) `pay_emergency`
    ) `pf1`
) `pf2`