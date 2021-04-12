import recipeActions from "./recipe/actions";
import ingredientActions from "./ingredient/actions";
import userActions from "./user/actions";

export default {
    initRecipes: recipeActions.initRecipes,
    setRecipes: recipeActions.setRecipes,
    setUserData: userActions.setUserData,
    initUserData: userActions.initUserData,
    setIngredients: ingredientActions.setIngredients,
    initIngredients: ingredientActions.initIngredients,
};
