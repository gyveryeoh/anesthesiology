select
    *
from (
    select
        asv.name service_name,
        t0.*
    from
        anesth_services asv
        left join (
            select
                *
            from (
                select
                    service_id,
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
                        asv.id `service_id`,
                        asv.name `service_name`,
                        pf.operation_date,
                        pf.service,
                        pf.user_id,
                        month(operation_date) month_operation_date
                    from
                        anesth_services asv,
                        patient_form pf
                    where
                        asv.id = pf.service
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
                    t0.service_id
            ) t0
        ) t0
        on asv.id = t0.service_id
    order by
        service_name
) t0
union all (
    select
        'TOTAL' service_name,
        -111 service_id,
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
        sum(if(month_operation_date = 12, 1, 0)) `DECE`,
        sum(1) `TOTAL`
    from (
        select
            asv.id `service_id`,
            asv.name `service_name`,
            pf.operation_date,
            pf.service,
            pf.user_id,
            month(operation_date) month_operation_date
        from
            anesth_services asv,
            patient_form pf
        where
            asv.id = pf.service
            and pf.anesth_status_id = (
                select anesth_status.id
                from
                    anesth_status
                where
                    upper(name) in ('APPROVED', 'APPROVE')
            )
            {$filters}
    ) t1
)