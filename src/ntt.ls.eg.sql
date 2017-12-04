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
				"src" = 0
				and
				(
					0 is null
					or
					"path" = 0
				)
		),
		0
	)
