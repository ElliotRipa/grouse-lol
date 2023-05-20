CREATE VIEW UnavailableMovieNames AS


	SELECT m.* FROM UnavailableMovies um
	LEFT JOIN Movies m ON um.id = m.id;
