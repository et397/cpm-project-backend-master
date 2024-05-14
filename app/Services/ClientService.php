<?php
    namespace App\Services;

    use App\Models\ClientConsultationInfo;
    use App\Models\CityDirectory;
    use App\Models\IndustryCategories;
    use App\Models\InquiryItems;
    use App\Models\IsBusinessRegistered;
    use Modules\Basic\Services\FunctionService;

    class ClientService extends FunctionService
    {
        protected $repo;

        /**
     * Summary of __construct
     * @param $repository
     */
        public function __construct($repository)
        {
            $this->repo = $repository;
        }

        /**
         * Summary of store
         * @param array $data
         * @return ClientConsultationInfo
         */
        public function store($data)
        {
            $clientData = $this->repo->create($data);

            return $this->repo->findById($clientData->id);
        }

        /**
         * Summary of getInitialOptions
         * @return array
         */
        public function getLastOne()
        {
            $lastInfo = $this->repo->get(function($query){
                $query->orderBy('created_at', 'desc');
            });
            return $lastInfo->first();
        }

        /**
         * Summary of getLastTen
         * @param int $page
         * @param int $perPage
         * @return \Illuminate\Pagination\LengthAwarePaginator
         */
        public function getLastTen(int $page = 1, int $perPage = 10)
        {
            $lastInfo = $this->repo->get(function($query){
                $query->orderBy('created_at', 'desc');
            });
            return $lastInfo->paginate($perPage, ['*'], 'page', $page);
        }
    }