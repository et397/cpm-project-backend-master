<?php
    use App\Models\ClientConsultationInfo;
    // use App\Models\CityDirectory;
    // use App\Models\IndustryCategories;
    // use App\Models\InquiryItems;
    // use App\Models\IsBusinessRegistered;
    use Modules\Basic\Repositories\FunctionRepository;
    use Illuminate\Database\Eloquent\Model;

    class ClientDataRepositories extends FunctionRepository{
        public function model(): string
        {
            return ClientConsultationInfo::class;
        }

        function getLastTen(int $page = 1, int $perPage = 10): array
        {
            $info = $this->paginate(function ($builder) {
                $builder->orderBy('created_at', 'desc');
            }, $page, $perPage);

            return $info->toArray();
        }

        function getLastOne()
        {
            $info = $this->first(function ($builder) {
                $builder->orderBy('created_at', 'desc');
            });

            return $info->toArray();
        }

        function create(array $data): Model
        {
            $info = $this->model->create($data);
            return $info;
        }
    }
       
