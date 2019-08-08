<?php

return [
    /**
     * @SWG\Get(
     *   path="/v1/todo",
     *   summary="todo app",
     *   tags={"ToDo"},
     *   @SWG\Response(
     *     response=200,
     *     description="Detail Information ToDo App",
     *     @SWG\Schema(ref="#/definitions/About")
     *   ),
     *  @SWG\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @SWG\Schema(ref="#/definitions/Unauthorized")
     *     )
     * )
     */
    'GET todo' => 'to-do/index',
    'OPTIONS todo' => 'to-do/index',

    /**
     * @SWG\Get(
     *   path="/v1/todo/{id}",
     *   summary="get one todo item",
     *   tags={"ToDo"},
     *   @SWG\Parameter(
     *        ref="#/parameters/id"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Detail Information ToDo App",
     *     @SWG\Schema(ref="#/definitions/About")
     *   ),
     *  @SWG\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @SWG\Schema(ref="#/definitions/Unauthorized")
     *     )
     * )
     */
    'GET todo/{id}' => 'to-do/get-one',
    'OPTIONS todo/{id}' => 'to-do/get-one',

     /**
      * @SWG\Put(
      *     path="/v1/todo/{id}",
      *     summary="todo app update",
      *     tags={"ToDo"},
      *     @SWG\Parameter(
      *         ref="#/parameters/id"
      *     ),
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         description="Create new ToDo item",
      *         required=true,
      *         @SWG\Schema(ref="#/definitions/ToDo"),
      *     ),
      *     @SWG\Response(
      *         response=202,
      *         description="ToDo"
      *
      *     ),
      *     @SWG\Response(
      *         response=422,
      *         description="ValidateErrorException",
      *         @SWG\Schema(ref="#/definitions/ErrorValidate")
      *     )
      * )
      */
     'PUT todo/{id}' => 'to-do/update',
     'OPTIONS todo/{id}' => 'to-do/update',

    /**
     * @SWG\Post(
     *     path="/v1/todo",
     *     summary="Create todo item",
     *     tags={"ToDo"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Create new ToDo item",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/ToDo"),
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Data news",
     *         @SWG\Schema(ref="#/definitions/CreateToDo")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     */
    'POST todo' => 'to-do/create',
    'OPTIONS todo' => 'to-do/create',

    /**
     * @SWG\Delete(
     *     path="/v1/todo/{id}",
     *     summary="Delete todo item",
     *     tags={"ToDo"},
     *     @SWG\Parameter(
     *         ref="#/parameters/id"
     *     ),
     *     @SWG\Response(
     *         response=202,
     *         description="Status Delete",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Resource not found",
     *         @SWG\Schema(ref="#/definitions/Not Found")
     *     )
     * )
     */
    'DELETE todo/{id}' => 'to-do/delete',
    'OPTIONS todo/{id}' => 'to-do/delete',

    /**
     * @SWG\Delete(
     *     path="/v1/todo/delete-all",
     *     summary="Delete todo all items",
     *     tags={"ToDo"},
     *     @SWG\Response(
     *         response=202,
     *         description="Status Delete",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Resource not found",
     *         @SWG\Schema(ref="#/definitions/Not Found")
     *     )
     * )
     */
    'DELETE todo/delete-all' => 'to-do/delete-all',
    'OPTIONS todo/delete-all' => 'to-do/delete-all',

];