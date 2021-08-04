<?php


namespace App;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Builder;

trait QueryHelper
{
    public function parseQueries(Request $request)
    {
        $query = $this::query();

        /** parse orders */
        $query = $this->parseOrders($query, $request);

        /** parse findable */
        $columns = $request->input("parsable", []);
        foreach ($columns as $column) {
            $query = $this->parseFind($query, json_decode($column));
        }

        /** parse search */
        $columns = $request->input("search", []);
        foreach ($columns as $column) {
            $query = $this->parseSearch($query, json_decode($column));
        }

        /** parse full_text search */
        $fullText = $request->input("full_text", "");
        if (strlen($fullText)) {
            $columns = $this->fullTextIndex;
            $query = $query->where(function ($query) /** @param $search JoinClause */ use ($fullText, $columns) {
                foreach ($columns as $key => $column) {
                    if ($key == 0) $query->where($column, "LIKE", "%$fullText%");
                    else $query->orWhere($column, "LIKE", "%$fullText%");
                }
            });
        }

        /** parse wheres */
        $columns = $request->input("wheres", []);
        foreach ($columns as $column) {
            $query = $this->parseWheres($query, json_decode($column));
        }

        return $query;
    }

    public function parseWheres(Builder $query, $input): Builder
    {
        if (!(isset($input->value) && isset($input->operation))) return $query;
        if (!strlen($input->value) || !strlen($input->operation)) return $query;

        if ($input->value == "null" && $input->operation == "is") {
            return $query->whereNull($input->column);
        } else if ($input->value == "null" && $input->operation == "not") {
            return $query->whereNotNull($input->column);
        } else {
            return $query->where($input->column, $input->operation, $input->value);
        }
    }

    public function parseSearch(Builder $query, $input): Builder
    {
        if (!isset($input->target)) return $query;
        if (!strlen($input->target)) return $query;
        return $query->where($input->column, "LIKE", "%$input->target%");
    }

    public function parseFind(Builder $query, $input): Builder
    {
        if (!(isset($input->column) && isset($input->queries))) return $query;

        $column = $input->column;
        $queries = $input->queries;

        if (!strlen($queries)) return $query;

        if (strpos($queries, ",") !== false) {
            return $query->whereIn($column, explode(",", $queries));
        }

        if (strpos($queries, "-") !== false) {
            $array = explode("-", $queries);

            if (count($array) == 2)
                return $query->whereBetween($column, $array);
            else
                return $query->whereIn($column, $array);
        }

        return $query->where($column, $queries);
    }

    public function parseOrders(Builder $query, Request $request): Builder
    {
        return $query->orderBy(
            $request->input("order", "id"),
            $request->input("direction", "desc")
        );
    }
}
