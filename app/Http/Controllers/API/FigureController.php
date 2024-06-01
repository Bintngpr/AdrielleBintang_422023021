<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Figure;
use OpenApi\Annotations as OA;


/**
 * Class Controller,
 * 
 * @author Bintang <adrielle.422023021@civitas.ukrida.ac.id>
 */

class FigureController extends Controller
{

    /** 
     * @OA\Get(
     *     path="/api/figure",
     *     tags={"Figure"},
     *     summary="Display a listing of the items",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function index()
    {
        return Figure::get();
    }



    /**
     * @OA\Post(
     *     path="/api/figure",
     *     tags={"Figure"},
     *     summary="Store a newly created item",
     *     operationId="store",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body description",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Figure",
     *             example={"title": "Hinata", "series": "Haikyuu", "manufacturer": "Orange Rouge", "release_year": "2017", "category": "figma", 
     *                      "cover": "https://images.goodsmile.info/cgm/images/product/20170616/6503/45891/large/9e1b7effe4c668ac66d4afb4fcb11f13.jpg", 
     *                      "price": 500000}
     *         ),
     *     ),
     *      security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */


    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'title'  => 'required|unique:figures',
                'manufacturer'  => 'required|max:100',
            ]);
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
            $figure = new Figure;
            $figure->fill($request->all())->save();
            return $figure;

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid Data : {$exception->getMessage()}");
        }
    }


    /**
     * @OA\Get(
     *     path="/api/figure/{id}",
     *     tags={"Figure"},
     *     summary="Display the specified item",
     *     operationId="show",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be displayed",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     * )
     */


    public function show($id)
    {
        $figure = Figure::find($id);
        if(!$figure){
            throw new HttpException(404, 'Item not found');
        }
        return $figure;
    }


    /**
     * @OA\Put(
     *     path="/api/figure/{id}",
     *     tags={"Figure"},
     *     summary="Update the specified item",
     *     operationId="update",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body description",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Figure",
     *             example={"title": "Hinata", "series": "Haikyuu", "manufacturer": "Orange Rouge", "release_year": "2017", "category": "figma", 
     *                      "cover": "https://images.goodsmile.info/cgm/images/product/20170616/6503/45891/large/9e1b7effe4c668ac66d4afb4fcb11f13.jpg", 
     *                      "price": 500000}
     *         ),
     *     ),
     *      security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */

    public function update(Request $request, string $id)
    {
        $figure = Figure::find($id);
        if(!$figure){
            throw new HttpException(404, 'Item not found');
        }

        try{
            $validator = Validator::make($request->all(), [
                'title'  => 'required|unique:figures',
                'manufacturer'  => 'required|max:100',
            ]);
            if ($validator->fails()) {
                throw new HttpException(400, $validator->messages()->first());
            }
           $figure->fill($request->all())->save();
           return response()->json(array('message'=>'Updated successfully'), 200);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid Data : {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/figure/{id}",
     *     tags={"Figure"},
     *     summary="Remove the specified item",
     *     operationId="destroy",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be removed",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *      security={{"passport_token_ready":{}, "passport":{}}}
     * )
     */
    
    public function destroy(string $id)
    {
        $figure = Figure::find($id);
        if(!$figure){
            throw new HttpException(404, 'Item not found');
        }

        try {
            $figure->delete();
            return response()->json(array('message'=>'Deleted successfully'), 200);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }
}