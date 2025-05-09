SELECT
    MONTH(Datum) - 1 AS maand,
    COUNT(*) AS aantal
FROM Reservering
GROUP BY MONTH(Datum) - 1
ORDER BY maand;