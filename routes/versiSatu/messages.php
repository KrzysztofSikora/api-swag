<?php

return [
    /**
     * @SWG\Get(
     *   path="/v1/messages",
     *   summary="messages app",
     *   tags={"Messages"},
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
    'GET messages' => 'messages/index',
    'OPTIONS messages' => 'messages/index',

    /**
     * @SWG\Get(
     *   path="/v1/messages/{id}",
     *   summary="get one messages item",
     *   tags={"Messages"},
     *   @SWG\Parameter(
     *        ref="#/parameters/id"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Detail Information messages App",
     *     @SWG\Schema(ref="#/definitions/About")
     *   ),
     *  @SWG\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @SWG\Schema(ref="#/definitions/Unauthorized")
     *     )
     * )
     */
    'GET messages/{id}' => 'messages/get-one',
    'OPTIONS messages/{id}' => 'messages/get-one',

     /**
      * @SWG\Put(
      *     path="/v1/messages/{id}",
      *     summary="messages app update",
      *     tags={"Messages"},
      *     @SWG\Parameter(
      *         ref="#/parameters/id"
      *     ),
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         description="Create new messages item",
      *         required=true,
      *         @SWG\Schema(ref="#/definitions/ToDo"),
      *     ),
      *     @SWG\Response(
      *         response=202,
      *         description="Messages"
      *
      *     ),
      *     @SWG\Response(
      *         response=422,
      *         description="ValidateErrorException",
      *         @SWG\Schema(ref="#/definitions/ErrorValidate")
      *     )
      * )
      */
     'PUT messages/{id}' => 'messages/update',
     'OPTIONS messages/{id}' => 'messages/update',

    /**
     * @SWG\Post(
     *     path="/v1/messages",
     *     summary="Create messages item",
     *     tags={"Messages"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Create new Messages item",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Messages"),
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Data news",
     *         @SWG\Schema(ref="#/definitions/CreateMessages")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     */
    'POST messages' => 'messages/create',
    'OPTIONS messages' => 'messages/create',

    /**
     * @SWG\Delete(
     *     path="/v1/messages/{id}",
     *     summary="Delete messages item",
     *     tags={"Messages"},
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
    'DELETE messages/{id}' => 'messages/delete',
    'OPTIONS messages/{id}' => 'messages/delete',

    /**
     * @SWG\Delete(
     *     path="/v1/messages/delete-all",
     *     summary="Delete messages all items",
     *     tags={"Messages"},
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
    'DELETE messages/delete-all' => 'messages/delete-all',
    'OPTIONS messages/delete-all' => 'messages/delete-all',

];