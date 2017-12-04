select
	"key"
from
	"ntt"
where
	"id" =
	coalesce
	(
		(
			select
				"dest"
			from
				"ntt.path.any"
			where
				"src" = :src
				and
				(
					(
						:path is null
						and
						"path" not like '%/%'
					)
					or
					"path" = :path
				)
		),
		0
	)
