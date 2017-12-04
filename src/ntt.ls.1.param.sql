select
	*
from
	"ntt.path.any"
where
			"src"
			||
			(
				select
					"value"
				from
					"sys.dft"
				where
					"id" = :sys
					and
					"key" = :path_delim
			)
			||
			"path"
			||
			(
				select
					"value"
				from
					"sys.dft"
				where
					"id" = :sys
					and
					"key" = :path_delim
			)
		like
			:path
			||
			'%'
			||
			(
				select
					"value"
				from
					"sys.dft"
				where
					"id" = :sys
					and
					"key" = :path_delim
			)
	and
			"path"
		not like
			'%'
			||
			(
				select
					"value"
				from
					"sys.dft"
				where
					"id" = :sys
					and
					"key" = :path_delim
			)
			||
			'%'
