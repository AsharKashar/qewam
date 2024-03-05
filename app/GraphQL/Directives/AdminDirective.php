<?php

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use App\Exceptions\customException;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\DefinedDirective;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Exceptions\AuthenticationException as ExceptionsAuthenticationException;

class AdminDirective extends BaseDirective implements FieldMiddleware, DefinedDirective
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

            $user =  Auth::user();
        if($user){
            if($user->role != 'admin'){
                // return response()->json(['error' => 'user not of start up role'], 403);
                throw new ExceptionsAuthenticationException(
                    'Role type error: The users role is not admin',
                    // 'This user does not belong to Startup role type'
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
