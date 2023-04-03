<?php



class Movies

{

    public function read($resource_id, $params = '')

    {

        try {



            $db_name     = 'media';

            $db_user     = 'website';

            $db_password = 'ne!JB9C2SK35';

            $db_host     = 'localhost';



            $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);



            $data = [];



            $sql  = "select *

                    from movies

                    ";



            if (!empty($resource_id)) {



                $sql .= " where id = :id";

                $data['id'] = $resource_id;



            } else {



                $filter = '';



                if (isset($params['name']) ) {

                    $filter .=" and name = :name";

                    $data['name'] = $params['name'];

                }

		if (isset($params['release_date']) ) {

                    $filter .=" and release_date = :release_date";

                    $data['release_date'] = $params['release_date'];

                }

		//This part doesn't work. Please fix.
		if (isset($params['imdb_rating']) ) {

                        $filter .=" and imdb_rating = :imdb_rating";

                        $data['imdb_rating'] = $params['imdb_rating'];

                }

		if (isset($params['imdb_id']) ) {

			$filter .=" and imdb_id = :imdb_id";

			$data['imdb_id'] = $params['imdb_id'];

		}

		if (isset($params['source']) ) {

                        $filter .=" and source = :source";

                        $data['source'] = $params['source'];

                }

		if (isset($params['path']) ) {

                        $filter .=" and path = :path";

                        $data['path'] = $params['path'];

                }

		if (isset($params['length']) ) {

                        $filter .=" and length = :length";

                        $data['length'] = $params['length'];

                }



                $sql .= " where id > 0 $filter";

            }



            $stmt = $pdo->prepare($sql);

            $stmt->execute($data);



            $movies = [];



            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $movies[] = $row;

            }



            $response = [];



            $response['data'] =  $movies;



            if (!empty($id)) {

               $response['data'] = array_shift($response['data']);

            }



           return json_encode($response, JSON_PRETTY_PRINT);



    } catch (PDOException $ex) {

            $error = [];

            $error['message'] = $ex->getMessage();



            return $error;

    }

    }

}
