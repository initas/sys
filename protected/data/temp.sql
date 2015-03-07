DROP TABLE temptbl IF EXISTS;

CREATE TEMPORARY TABLE temptbl (created_at DATETIME PRIMARY KEY)
    AS (SELECT created_at FROM curhats)
    UNION (SELECT created_at FROM images)
    ORDER BY created_at;
	
SELECT
	curhats.id as curhat_id,
	images.id as image_id
FROM temptbl
LEFT OUTER JOIN
	curhats USING (created_at)
LEFT OUTER JOIN
	images USING (created_at)
order by
	created_at desc;