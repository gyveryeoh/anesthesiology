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
                '<b>Total</b>' `name`
        )
    ) t0
    {$joins}