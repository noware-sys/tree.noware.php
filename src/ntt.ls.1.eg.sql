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
					"id" = 'sys'
					and
					"key" = 'path.delim'
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
					"id" = 'sys'
					and
					"key" = 'path.delim'
			)
		like
			0
			||
			'%'
			||
			(
				select
					"value"
				from
					"sys.dft"
				where
					"id" = 'sys'
					and
					"key" = 'path.delim'
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
					"id" = 'sys'
					and
					"key" = 'path.delim'
			)
			||
			'%'
	