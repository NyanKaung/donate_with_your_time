<?php

namespace App\Traits;

trait Query
{
    /**
     * filter by keyword
     * @param query
     * @param columns<array>
     * ['name', 'title', etc...]
     * @param keyword<string>
     */
    private function _filter($query, $columns, $keyword)
    {
        if (!empty($keyword)) {
            $query = $query->whereRaw(
                "{$this->_concatColumns($columns)} like  ?",
                ["%{$this->_trimAllWhiteSpaceFromKeyword($keyword)}%"]
            );
        }
        return $query;
    }

    /**
     * paginate data
     * @param query
     * @param page<int>
     * @param limit<'all'|int>
     */
    private function _paginate($query, $page, $limit)
    {
        if ($limit == 'all') {
            return $query;
        }
        $offset = (intval($page) - 1) * intval($limit);
        if ($limit != 'all') {
            $query = $query
        ->offset($offset)
        ->limit($limit);
        }
        return $query;
    }

    /**
     * Sort Data
     * @param query
     * @param sorts<array>
     * [
     *  [
     *     'column' => <string>
     *     'type'   => 'asc'|'desc
     *  ]....
     * ]
     */
    private function _sort($query, $sorts)
    {
        foreach ($sorts as $sort) {
            if (!is_array($sort)) {
                $sort = json_decode($sort, true);
            }
            $query = $query->orderBy($sort['column'], $sort['type']);
        }
        return $query;
    }

    /**
     * concat names to filter correct
     * @param array $inputColumns
     * @return string
     */
    private function _concatColumns(array $inputColumns)
    {
        $columns = '';
        foreach ($inputColumns as $key => $column) {
            $columns .= ($key == 0)
      ? sprintf(" IFNULL(%s, '' )", $column)
      : sprintf(", IFNULL(%s, '' ) ", $column);
        }
        return "REPLACE( concat( $columns ) , ' ', '') ";
    }

    /**
     * trim all white space from string to search
     * @param string $keyword
     * @return string
     */
    private function _trimAllWhiteSpaceFromKeyword($keyword)
    {
        return preg_replace('/\s+/', '', $keyword);
    }
}