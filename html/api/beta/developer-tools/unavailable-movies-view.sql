CREATE VIEW UnavailableMovies AS


	SELECT m.id FROM Movies m

	EXCEPT

	SELECT dm.movie FROM DownloadedMovies dm

	EXCEPT

	SELECT lm.movie FROM LinkedMovies lm

	EXCEPT

	SELECT nm.movie FROM NetflixMovies nm

	EXCEPT

	SELECT cm.movie FROM CineasternaMovies cm

	EXCEPT

	SELECT ym.movie FROM YouTubeMovies ym;
