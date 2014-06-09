select
    *
from (
    select
        asv.name anesthetic_name,
        t0.*
    from
        anesth_technique asv
        left join (
            select
                *
            from (
                select
                    anesthetic_id,
                    sum(if(month_operation_date = 1, 1, 0)) `JAN`,
                    sum(if(month_operation_date = 2, 1, 0)) `FEB`,
                    sum(if(month_operation_date = 3, 1, 0)) `MAR`,
                    sum(if(month_operation_date = 4, 1, 0)) `APR`,
                    sum(if(month_operation_date = 5, 1, 0)) `MAY`,
                    sum(if(month_operation_date = 6, 1, 0)) `JUN`,
                    sum(if(month_operation_date = 7, 1, 0)) `JUL`,
                    sum(if(month_operation_date = 8, 1, 0)) `AUG`,
                    sum(if(month_operation_date = 9, 1, 0)) `SEP`,
                    sum(if(month_operation_date = 10, 1, 0)) `OCT`,
                    sum(if(month_operation_date = 11, 1, 0)) `NOV`,
                    sum(if(month_operation_date = 12, 1, 0)) `DEC`,
                    sum(1) `TOTAL`
                from (
                    select
                        asv.id `anesthetic_id`,
                        asv.name `anesthetic_name`,
                        pf.operation_date,
                        pf.anesthetic_technique,
                        pf.user_id,
                        month(operation_date) month_operation_date
                    from
                        anesth_technique asv,
                        patient_form pf
                    where
                        asv.id = pf.anesthetic_technique
            
                        and pf.anesth_status_id = (
                            select
                                id
                            from
                                anesth_status
                            where
                                upper(name) in ('APPROVED', 'APPROVE')
                        )
                        {$filters}
                ) t0
                group by
                    t0.anesthetic_id
            ) t0
        ) t0
        on asv.id = t0.anesthetic_id
    order by
        anesthetic_name
) t0
union all (
    select
        'TOTAL' anesthetic_name,
        -111 anesthetic_id,
        sum(if(month_operation_date = 1, 1, 0)) `JAN`,
        sum(if(month_operation_date = 2, 1, 0)) `FEB`,
        sum(if(month_operation_date = 3, 1, 0)) `MAR`,
        sum(if(month_operation_date = 4, 1, 0)) `APR`,
        sum(if(month_operation_date = 5, 1, 0)) `MAY`,
        sum(if(month_operation_date = 6, 1, 0)) `JUN`,
        sum(if(month_operation_date = 7, 1, 0)) `JUL`,
        sum(if(month_operation_date = 8, 1, 0)) `AUG`,
        sum(if(month_operation_date = 9, 1, 0)) `SEP`,
        sum(if(month_operation_date = 10, 1, 0)) `OCT`,
        sum(if(month_operation_date = 11, 1, 0)) `NOV`,
        sum(if(month_operation_date = 12, 1, 0)) `DEC`,
        sum(1) `TOTAL`
    from (
        select
            asv.id `anesthetic_id`,
            asv.name `anesthetic_name`,
            pf.operation_date,
            pf.anesthetic_technique,
            pf.user_id,
            month(operation_date) month_operation_date
        from
            anesth_technique asv,
            patient_form pf
        where
            asv.id = pf.anesthetic_technique
            and pf.anesth_status_id = (
                select
                    id
                from
                    anesth_status
                where
                    upper(name) in ('APPROVED', 'APPROVE')
            )
            {$filters}
            and institution_id in ('2')
    ) t1
)