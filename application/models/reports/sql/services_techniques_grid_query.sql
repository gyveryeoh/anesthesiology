select
    t0.name `Service - Technique`,
    {$cols}
from (
        select
            *
        from
            anesth_services t0
        union (
            select
                -111 `id`,
                'ZTOTAL' `name`
        )
    ) t0
    {$joins}
    order by t0.name asc