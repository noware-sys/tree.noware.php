select
	count (*)
from
	"ntt.path.any"
where
	"src" = :src
	and
	(
		:path is null
		or
		:path = ''
		or
		"path" = :path
	)
