<?php

namespace App\GraphQL\Directives;

use App\Exceptions\customException;
use Closure;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\DefinedDirective;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Exception;


class JwtVerifcationDirective extends BaseDirective implements FieldMiddleware, DefinedDirective
{
    // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
directive @startup on FIELD_DEFINITION
GRAPHQL;
    }
    // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html
    public function handleField(FieldValue $fieldValue, Closure $next)
    {
        // Retrieve the existing resolver function
        /** @var Closure $previousResolver */
        $resolver = $fieldValue->getResolver();

        // Wrap around the resolver
        $fieldValue->setResolver(function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo) use ($resolver) {
            // Do something before the resolver, e.g. validate $args, check authentication
            $result = $resolver($root, $args, $context, $resolveInfo);

            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    // return response()->json(['error' => 'Token is Invalid'], 403);
                    throw new customException(
                        'Token is invalid',
                        'The issue is related to authorization bearer token'
                    );

                } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    // return response()->json(['error' => 'Token is Expired'], 403);
                    throw new customException(
                        'Token is Expired',
                        'The issue is related to authorization bearer token'
                    );
                } else {
                    // return response()->json(['error' => 'Authorization Token not found'], 403);
                    throw new customException(
                        'Token not found',
                        'The issue is related to authorization bearer token'
                    );
                }
            }
            return $result;

        });

        // Keep the chain of adding field middleware going by calling the next handler.
        // Calling this before or after ->setResolver() allows you to control the
        // order in which middleware is wrapped around the field.

        // $
        return $next($fieldValue);
    }
}
