select
	"key", "value.type"
from
	"ntt"
where
	"id" =
	coalesce
	(
		-- When the subpath and a source root entity's ID are provided.
		(
			select
				"dest"
			from
				"ntt.path.any"
			where
				"src" = :src
				and
				"path" = :path
		),
		
		-- When only a source root entity's ID is provided, and not a subpath.
		(
			select
				"src"
			from
				"ntt.path.any"
			where
				(
					:path is null
					or
					:path = ''
				)
				and
				"src" = :src
			limit 1
		),
		
		-- When the root entity's ID, which is provided, is present.
		(
			select
				"id"
			from
				"ntt"
			where
				"id" = :src
			limit 1
		),
		
		-- The default entity ID.
		0
	)
