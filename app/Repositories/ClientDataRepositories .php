<?php
    use App\Models\ClientConsultationInfo;
    // use App\Models\CityDirectory;
    // use App\Models\IndustryCategories;
    // use App\Models\InquiryItems;
    // use App\Models\IsBusinessRegistered;
    use Knuckles\Scribe\Attributes\BodyParam;
    use Modules\Basic\Repositories\FunctionRepository;
    use Illuminate\Database\Eloquent\Model;

    class ClientDataRepositories extends FunctionRepository{
        public function model(): string
        {
            return ClientConsultationInfo::class;
        }
        /**
         * 資料按創建日期倒序，每頁10筆
         */
        #[BodyParam('page', description: 'Page number', example: 1)]

        function get(Closure $query, Illuminate\Database\Eloquent\Builder|null $builder = null, array $columns = ['*']): Illuminate\Database\Eloquent\Collection
        {
            $builder = $this->query($builder);
            $query($builder);
            return $builder->get($columns);
        }

        function first(Closure $query, Illuminate\Database\Eloquent\Builder|null $builder = null, array $columns = ['*']): Model
        {
            $builder = $this->query($builder);
            $query($builder);
            return $builder->firstOrFail($columns);
        }

        function paginate(Closure $query, int $page = 1, int $perPage = 15, Illuminate\Database\Eloquent\Builder|null $builder = null): Illuminate\Pagination\LengthAwarePaginator
        {
            $builder = $this->query($builder);
            $query($builder);
            return $builder->paginate($perPage, ['*'], 'page', $page);
        }

        function create(array $data): Model
        {
            return $this->model->create($data);
        }
    }
       
