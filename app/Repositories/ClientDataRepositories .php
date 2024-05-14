<?php
    use App\Models\ClientConsultationInfo;
    // use App\Models\CityDirectory;
    // use App\Models\IndustryCategories;
    // use App\Models\InquiryItems;
    // use App\Models\IsBusinessRegistered;
    use Illuminate\Pagination\Paginator;
    use Knuckles\Scribe\Attributes\BodyParam;
    use Knuckles\Scribe\Attributes\QueryParam;
    use Modules\Basic\Repositories\FunctionRepository;
    use Illuminate\Database\Eloquent\Model;

    class ClientDataRepositories extends FunctionRepository{
        public function model(): string
        {
            return ClientConsultationInfo::class;
        }
       
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

        function findById(int $id, array $columns = ['*'], array $relations = []): Model
        {
            $builder = $this->query(null);
            return $builder->with($relations)->find($id, $columns);
        }

    }
       
